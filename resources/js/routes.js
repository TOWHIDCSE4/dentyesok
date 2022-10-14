import Login from "./views/auth/Login";
import Registration from "./views/auth/Registration";
import Profile from "./views/auth/Profile";
import Dashboard from "./views/dashboard/Dashboard";
import Employee from "./views/employee/Employee";
import Role from "./views/role/Role";
import User from "./views/user/User";
import Organization from "./views/organization/Organization";


export const routes = [
    {path: '/login', component: Login, name: 'login'},
    {path: '/register', component: Registration, name: 'register'},
    {path: '/profile', component: Profile, name: 'profile'},
    {path: '/home', component: Dashboard, name: 'dashboard'},
    {path: '/employee', component: Employee, name: 'employee'},
    {path: '/role', component: Role, name: 'role'},
    {path: '/user', component: User, name: 'user'},
    {path: '/organization', component: Organization, name: 'organization'},

]