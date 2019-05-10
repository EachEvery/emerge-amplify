export default el => {
    var temp = document.createElement(el.nodeName);
    temp.setAttribute(
        "style",
        "margin:0px;padding:0px;font-family:" +
            el.style.fontFamily +
            ";font-size:" +
            el.style.fontSize
    );
    temp.innerHTML = "test";
    temp = el.parentNode.appendChild(temp);
    var ret = temp.clientHeight;
    temp.parentNode.removeChild(temp);
    return ret;
};
