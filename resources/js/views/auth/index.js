import Login from './Login'
import Registration from './Registration'
import Profile from "./Profile";

export default [
    {path: '/login', component: Login, name: 'login'},
    {path: '/register', component: Registration, name: 'register'},
    {path: '/profile', component: Profile, name: 'profile'},

]