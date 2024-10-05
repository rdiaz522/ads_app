export default function useHandleError(error) {
    let errorMessage = {};
    if (typeof error === "object") {
        return Object.assign(errorMessage, error);
    } else {
        return error;
    }
}
