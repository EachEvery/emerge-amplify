import { getPoems, findPoem } from "../../api";
import $ from "jquery";

export const SET_POEMS = "SET_POEMS";
export const INIT_POEMS = "INIT_POEMS";
export const ENSURE_POEMS = "ENSURE_POEMS";
export const FETCH_POEM = "FETCH_POEM";
export const ADD_POEM = "ADD_POEM";

export default {
    namespaced: true,
    state: {
        poems: []
    },
    mutations: {
        [SET_POEMS](state, poems) {
            state.poems = poems;
        },
        [ADD_POEM](state, poem) {
            state.poems.push(poem);
        }
    },
    getters: {
        poems({ poems }) {
            return poems;
        }
    },
    actions: {
        [INIT_POEMS](context, query) {
            return new Promise(async resolve => {
                let collection = context.rootGetters.collection;

                if (collection.is_portal) {
                    query = {
                        ...query,
                        collection_id: collection.id
                    };
                }

                let response = await getPoems($.param(query));

                context.commit(SET_POEMS, response.data);
                resolve(response.data);
            });
        },
        [FETCH_POEM](context, id) {
            return new Promise(async resolve => {
                let poem = await findPoem(id);

                if (poem === undefined) {
                    resolve(undefined);
                } else {
                    context.commit(ADD_POEM, poem);
                    resolve(poem);
                }
            });
        }
    }
};
