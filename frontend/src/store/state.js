export default {
    user: {
        token: sessionStorage.getItem('TOKEN'),
        data: {}
    },
    users: {
        loading: false,
        data: []
    },
    userUpdate: {
        loading: false,
        data: []
    }
}
