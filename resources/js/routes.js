import Home from './components/Home.vue';
import Task from './components/Task.vue';

export default [
    {
        path : '/',
        component : Home,
        name : 'home'
    },
    {
        path : '/tasks',
        component : Task,
        name : 'task'
    },
]