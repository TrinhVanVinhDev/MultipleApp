import axiosClient from "../axios";

export function getCurrentUser({commit}, data) {
    return axiosClient.get('/user', data)
        .then(({data}) => {
            commit('setUser', data);
            return data;
        })
}

export function login({commit}, data) {
    return axiosClient.post('/login', data)
        .then(({data}) => {
            commit('setUser', data.user);
            commit('setToken', data.token);
            return data;
        })
}

export function logout({commit}) {
    return axiosClient.post('/logout')
        .then((response) => {
            commit('setToken', null);
            commit('setUser', null);
            return response;
        })
}

export function regisAccount({commit}, data) {
    return axiosClient.post('/registered', data)
        .then(({data}) => {
            commit('setUser', data.user);
            commit('setToken', data.token);
            return data;
        });
}

export function getUserList({commit}, data) {
    commit('setUsers', [true])
    return axiosClient.get('/users', data)
        .then((response) => {
            commit('setUsers', [false, response.data]);
        })
        .catch(() => {
           commit('setUsers', false);
        });
}

export function deleteUser({commit}, id) {
    return axiosClient.delete(`/user/${id}`)
}
