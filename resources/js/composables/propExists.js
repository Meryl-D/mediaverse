export function usepropExists(property, data) {
    return `${property}` in data.value;
}