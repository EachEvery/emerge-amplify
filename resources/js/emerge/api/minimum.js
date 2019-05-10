export default async (promise, minimum = 2000) => {
    const resolutions = await Promise.all([
        promise,
        new Promise(resolve => {
            window.setTimeout(resolve, minimum, undefined);
        })
    ]);
    return Promise.resolve(resolutions.find(res => res !== undefined));
};
