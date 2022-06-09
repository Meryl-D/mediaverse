export function usePropExists(property, data) {
    return `${property}` in data;
}