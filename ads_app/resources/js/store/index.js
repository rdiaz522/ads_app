import {createStore} from 'vuex'
import Loading from '@/store/modules/Loading';
import Sessions from '@/store/modules/Sessions';
import createPersistedState from 'vuex-persistedstate';

const store = createStore({
    modules: {
        Loading: Loading,
        Sessions: Sessions
    },
    plugins: [createPersistedState({
        key: 'myApp', // You can set a custom key for the persisted state
        paths: ['Sessions'] // Specify which modules to persist
    })]
})

export default store;



