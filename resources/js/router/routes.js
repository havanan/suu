import Home from '../components/HomeComponent'
import NotFound from '../components/NotFoundComponent'
import Dashboard from "../views/manager/Dashboard";
import Manager from "../layouts/Manager";
import Login from "../views/manager/auth/Login";
import Auth from "../layouts/Auth";
const routes = [
    {
        path: '*',
        component: NotFound
    },
    {
        path: '/',
        component: Home,
    },
    {
        path: '/manager/login',
        component: Login,
        meta :{ layout: Auth},
        name: 'managerLogin'
    },
    {
        path: '/manager',
        component: Dashboard,
        meta :{ layout: Manager},
        name: 'managerDashboard',
        // beforeEnter:(to,from,next) => {
        //             axios.get('/api/v1/manager/current-user').then(() => {
        //                 next()
        //             }).catch(() => {
        //                 return next ({name:'managerLogin'})
        //             })
        //         },
    },
];

export default routes;
