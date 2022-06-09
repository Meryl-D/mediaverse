import { useLocalstorage } from "./composables/localStorage";

export const { value: user } = useLocalstorage('user', {
    firstName : '',
    lastName : '',
    role : '',
    token : ''
});

export function propExists(property, data) {
    return `${property}` in data;
}

export function chunkArrayInGroups(arr, size) {
    let chunksArray = [];
    for(var i = 0; i < arr.length; i += size) {
        chunksArray.push(arr.slice(i, i + size));
    }
    return chunksArray;
}