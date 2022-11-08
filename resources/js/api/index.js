import axios from "axios";

const API_URL = "http://localhost:8000/api/";

const instance = axios.create({
    baseURL: API_URL,
});

async function getRequest(url, token) {
    const get = await instance.get(url, {
        headers: { Authorization: "Bearer " + token }
    });
    return get;
}

async function getRequestUrlValue(url, token, value) {
    const get = await instance.get(url+"/"+value, {
        headers: { Authorization: "Bearer " + token }
    }).catch(function (errors) {
        return errors;
    });
    return get;
}

async function getRequestQuery(url, token, query) {
    const get = await instance.get(url, {
        params: query,
        headers: { Authorization: "Bearer " + token }
    }).catch(function (errors) {
        return errors;
    });
    return get;
}

async function postRequest(url, token, data) {
    const post = await instance.post(
        url,
        data,
        {
            headers: { Authorization: "Bearer " + token }
        }
    );
    return post;
}

async function deleteRequestUrlValue(url, token, value) {
    await instance.delete(url+"/"+value, {
        headers: { Authorization: "Bearer " + token }
    })
}

async function patchRequestUrlValue(url, token, value, data) {
    const post = await instance.patch(
        url+"/"+value,
        data,
        {
            headers: { Authorization: "Bearer " + token }
        }
    );
    return post;
}

export { getRequest, postRequest, getRequestUrlValue, patchRequestUrlValue, deleteRequestUrlValue, getRequestQuery };
