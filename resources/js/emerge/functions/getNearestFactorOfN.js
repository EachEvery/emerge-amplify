export default (numberToRound, n) => {
    var resto = numberToRound % n;
    if (resto <= n / 2) {
        return numberToRound - resto;
    } else {
        return numberToRound + n - resto;
    }
};
