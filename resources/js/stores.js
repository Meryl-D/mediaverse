import { useLocalstorage } from "./composables/localStorage";

export const { value: user } = useLocalstorage('user', {
    id : null,
    firstName : '',
    lastName : '',
    token : ''
});