export function setUserLogin(state, user) {
    state.user.data = user;
    if(user) {
        sessionStorage.setItem('userId', user.id);
    } else {
        sessionStorage.removeItem('userId')
    }
}

export function setToken(state, token) {
    state.user.token = token;
    if (token) {
        sessionStorage.setItem('TOKEN', token);
    } else {
        sessionStorage.removeItem('TOKEN')
    }
}

export function setUsers(state, [loading, data = null]) {
    if (data) {
        state.users = {
            ...state.users,
            data: data.data
        }
    }
}

export function setUser(state, [loading, data = null]) {
    if (data) {
        state.userUpdate = {
            ...state.userUpdate,
            data: data.data
        }
    }
}
