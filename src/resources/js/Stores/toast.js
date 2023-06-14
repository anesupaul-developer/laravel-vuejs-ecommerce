import {reactive} from "vue";

export default reactive({
    items: [],
    remove(index) {
        this.items.splice(index, 1);
    },
    add(message, color = 'blue') {
        this.items.unshift({key: Symbol(), message, color});
    }
});