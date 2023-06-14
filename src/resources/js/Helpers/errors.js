import toast from "@/Stores/toast.js";

export const danger = {bgColor: 'red'};
export const success = {bgColor: 'green'};
export const warning = {bgColor: 'orange'};
export const info = {bgColor: 'blue'};

export default {
    displayErrors(params) {
        const keys = Object.keys(params);
        keys.forEach((key) => {
            toast.add(params[key], 'red');
        });
    },
    displaySuccess(params) {
        const keys = Object.keys(params);
        keys.forEach((key) => {
            toast.add(params[key], 'green');
        });
    },
    displayWarning(params) {
        const keys = Object.keys(params);
        keys.forEach((key) => {
            toast.add(params[key], 'orange');
        });
    },
    displayInfo(params) {
        const keys = Object.keys(params);
        keys.forEach((key) => {
            toast.add(params[key], 'blue');
        });
    }
}