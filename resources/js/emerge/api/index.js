import axios from "axios";
import formPost from "./formPost";

export const storePoem = form => {
    if (!form instanceof FormData) {
        form = new FormData(form);
    }
    return formPost("/poems", form);
};

export const storeMessage = form => {
    return formPost("/messages", new FormData(form));
};

export const getPoems = (query = "") => {
    return axios.get(`/poems/?${query}`);
};

export const findPoem = id => {
    return new Promise(async resolve => {
        try {
            let response = await axios.get(`/poems/${id}`);

            resolve(response.data);
        } catch (e) {
            resolve(undefined);
        }
    });
};
