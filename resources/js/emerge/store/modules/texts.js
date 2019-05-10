export const SET_SELECTED_TEXT = "SET_SELECTED_TEXT";
export const SET_SELECTED_OFFSET = "SET_SELECTED_OFFSET";

const initialState = () => ({
    selectedId: window.emerge.collection.texts[0].id,
    selectedOffset: null
});

export default {
    state: initialState,
    getters: {
        collection() {
            return window.emerge.collection;
        },
        texts() {
            return window.emerge.collection.texts;
        },
        selectedText({ selectedId }, { texts }) {
            let selectedText = texts.find(item => item.id === selectedId);
            return selectedText === undefined ? texts[0] : selectedText;
        },
        categoryColor({}, { selectedText }) {
            if (selectedText === undefined) {
                return "#fff";
            } else {
                return selectedText.category.color;
            }
        },
        selectedTextBgColor({}, { selectedText }) {
            if (selectedText === undefined) {
                return "#fff";
            } else {
                return selectedText.category.color_light;
            }
        }
    },
    mutations: {
        [SET_SELECTED_TEXT](state, id) {
            state.selectedId = parseInt(id);
        },
        [SET_SELECTED_OFFSET](state, offset) {
            state.selectedOffset = offset;
        }
    }
};
