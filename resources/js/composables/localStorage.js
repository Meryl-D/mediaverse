import { ref, watch } from "vue";

export function useLocalstorage(key, defaultVal = null) {

  let data = localStorage.getItem(key);

  // if allready in localstorage, we parse the JSON
  if (data !== null) {
    data = JSON.parse(data);
  // or we set it at the default val and save it in the storage
  } else {
    data = defaultVal;
    localStorage.setItem(key, JSON.stringify(data));
  }

  const value = ref(data);

  // every change of the data will be saved to the storage
  watch(value, () => {
    localStorage.setItem(key, JSON.stringify(value.value));
  }, {deep: true});

  return { value };
}