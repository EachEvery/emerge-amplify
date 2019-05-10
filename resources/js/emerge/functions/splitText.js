export const getWordStub = (p, w) => ({
    id: `${p}.${w}`,
    selected: false,
    bold: false,
    italic: false,
    underline: false,
    isLineBreak: false,
    word: ""
});

export default text => {
    let words = [];

    text.split("\n").forEach((paragraph, p) => {
        paragraph.split(" ").forEach((word, w) => {
            words.push({
                ...getWordStub(p, w),
                word
            });
        });

        words.push({
            ...getWordStub(p, "br"),
            isLineBreak: true
        });
    });

    return words;
};
