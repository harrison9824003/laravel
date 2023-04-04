const STORAGE_KEY = 'MY_APP_OKEN'

export default {
    namespaced: true,
    actions: {
        // 登入後儲存 token
        setToken(context, value) {
            localStorage.setItem(STORAGE_KEY, value._token)
            context.commit('SETTOKEN', value._token)
        },
        // 每次到頁面時載入 token
        loadMember(context, value) {
            const data = localStorage.getItem(STORAGE_KEY);
            console.log(data);
            context.commit('LOADMEMBER', data)
        }
    },
    mutations: {
        SETTOKEN(state, data) {
            state._token = data
        },
        LOADMEMBER(state, data) {
            state._token = data
        }
    },
    state: {
        _token: ''
    },
    getters: {
        getToken(state) {
            return state._token
        }
    }
}