import $ from "jquery";

export default (
    el,
    prop,
    val,
    duration = 150,
    easing = "swing",
    delayCallback = 300
) => {
    return new Promise(resolve => {
        $(el).animate({ [prop]: val }, duration, easing, () => {
            setTimeout(() => {
                resolve();
            }, delayCallback);
        });
    });
};
