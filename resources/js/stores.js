import { useLocalstorage } from "./composables/localStorage";

export const { value: user } = useLocalstorage('user', {
    firstName : '',
    lastName : '',
    role : '',
    token : ''
});