const Loading  = {
    namespaced: true,

    state: () => ({
        isLoading: false
    }),

    mutations: {
        PAGE_LOAD(state, isLoading) {
            state.isLoading = isLoading;
        }
    },

    actions: {

    },

    getters: {
        isLoading: state => state.isLoading
    }

}

export default Loading;
