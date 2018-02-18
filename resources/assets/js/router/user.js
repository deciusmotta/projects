import UserList from '../components/User/List'
let routes = {
    path: '/users',
    component: UserList,
    // children: [
    //     {
    //         // UserProfile will be rendered inside User's <router-view>
    //         // when /user/:id/profile is matched
    //         path: 'profile',
    //         component: UserProfile
    //     },
    //     {
    //         // UserPosts will be rendered inside User's <router-view>
    //         // when /user/:id/posts is matched
    //         path: 'posts',
    //         component: UserPosts
    //     }
}


export default routes