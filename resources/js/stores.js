import { useLocalstorage } from "./composables/localStorage";

export const { value : user } = useLocalstorage('user', {
    firstName : '',
    lastName : '',
    role : '',
    token : ''
});

export const { value : isActive } = useLocalstorage('isActive', {
    weekly : false,
    monthly : false,
    daily : true
})

export const { value : selectedDate } = useLocalstorage('selectedDate', '')

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