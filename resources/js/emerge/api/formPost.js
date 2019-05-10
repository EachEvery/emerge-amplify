import minimum from "./minimum";

export default async (url, data, method = "post", throttle = true) => {
    const req = () =>
        axios({
            method,
            url,
            data,
            config: {
                headers: {
                    "Content-Type": "multipart/form-data"
                }
            }
        });
    const response = (await throttle) ? minimum(req()) : req();

    return Promise.resolve(response);
};
