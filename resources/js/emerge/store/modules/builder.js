import splitText from "../../functions/splitText";
import Vue from "vue";

export const SET_WORD = "SET_WORD";
export const SET_OPACITY = "SET_OPACITY";
export const RESET = "RESET";
export const SET_USER_INTERACTED = "SET_USER_INTERACTED";
export const ENSURE_USER_INTERACTION = "ENSURE_USER_INTERACTION";
export const HARD_RESET = "HARD_RESET";
export const SET_WORDS = "SET_WORDS";
export const SET_BLOB = "SET_BLOB";
export const SET_FINAL_POEM_TITLE = "SET_FINAL_POEM_TITLE";
export const SET_FINAL_POEM_AUTHOR = "SET_FINAL_POEM_AUTHOR";

const initialState = () => ({
    words: [],
    userHasInteracted: false,
    baseOpacity: 15,
    collection: window.emerge.collection,
    blob: undefined,
    finalPoemTitle: "Your Poem",
    finalPoemAuthor: "You"
});

export default {
    state: initialState(),
    getters: {
        opacity({ userHasInteracted, baseOpacity }) {
            return userHasInteracted ? baseOpacity / 100 : 1;
        },

        finalPoem({ finalPoemAuthor, finalPoemTitle }) {
            return {
                author: finalPoemAuthor,
                title: finalPoemTitle
            };
        },

        wordObjects({}, {}, {}, { selectedText }) {
            return splitText(selectedText.content);
        },

        blob({ blob }) {
            return blob;
        },

        poemJson({ words }) {
            return JSON.stringify(words);
        }
    },
    mutations: {
        [SET_FINAL_POEM_AUTHOR](state, val) {
            state.finalPoemAuthor = val;
        },

        [SET_FINAL_POEM_TITLE](state, val) {
            state.finalPoemTitle = val;
        },

        [HARD_RESET](state) {
            const s = initialState();

            Object.keys(s).forEach(key => {
                state[key] = s[key];
            });
        },

        [RESET](state) {
            state.words.forEach((word, i) => {
                state.words[i].selected = false;
                state.words[i].italic = false;
                state.words[i].bold = false;
                state.words[i].underline = false;
            });
        },

        [SET_WORD](state, obj) {
            let index = state.words.findIndex(word => word.id === obj.id);

            state.words.splice(index, 1, obj);
        },

        [SET_BLOB](state, blob) {
            state.blob = blob;
        },

        [SET_OPACITY](state, opacity) {
            state.baseOpacity = opacity;
        },

        [SET_USER_INTERACTED](state, val) {
            state.userHasInteracted = val;
        },

        [SET_WORDS](state, words) {
            Object.assign(state.words, []);
            Object.assign(state.words, words);
        }
    },

    actions: {
        [ENSURE_USER_INTERACTION](context, delay = 0) {
            if (!context.state.userHasInteracted) {
                setTimeout(() => {
                    context.commit(SET_USER_INTERACTED, true);
                }, delay);
            }
        }
    }
};
