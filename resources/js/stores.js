import { useLocalstorage } from "./composables/localStorage";

export const { value: auth } = useLocalstorage('auth', '');