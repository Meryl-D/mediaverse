import { useLocalstorage } from "./composables/localStorage";
import { ref } from "vue";

export const { value : user } = useLocalstorage('user', {
    firstName : '',
    lastName : '',
    role : '',
    token : ''
});

export const { value : isActive } = useLocalstorage('isActive', {
    weekly : true,
    monthly : false,
    daily : false
})
export const isMobile =  ref();

export const { value : selectedDate } = useLocalstorage('selectedDate', '')

export const { value : selectedTasks } = useLocalstorage('selectedTasks', [])

export const { value : tasksTmpl } = useLocalstorage('tasksTmpl', [])

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
export function chunkArrayInMonth(days,currentMonth) {
    let chunksArray = [];
    if (days == currentMonth) {
        for(var i = 0; i < days.length; i += size) {
            chunksArray.push(days.slice(i, i + size));
        }
    }   
    return chunksArray;
}

export function formatHourForGrid(val) {
    return parseInt(val) + 1
}

export function goToWeeklyView() {
    isActive.value.monthly = false;
    isActive.value.daily = false;
    isActive.value.weekly = true;
  }
  export function goToMonthlyView() {
    isActive.value.monthly = true;
    isActive.value.daily = false;
    isActive.value.weekly = false;
  }
  export function goToDailyView() {
    isActive.value.monthly = false;
    isActive.value.daily = true;
    isActive.value.weekly = false;
  }