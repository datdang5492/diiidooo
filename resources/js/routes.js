import homepage from './components/homepage/Homepage';
import list from './components/list/List';
import detail from './components/detail/Detail';
import profile from './components/profile/Profile';
import profile_setting from './components/profile/profile_setting/ProfileSetting';
import photo from './components/profile/media/Photo';
import review from './components/profile/review/Review';
import add_shipment from './components/list/AddShipment';

export default [
    {path: '/', component: homepage},
    {path: '/list/from/:fromCity/to/:toCity', component: list},

    {path: '/become-a-shipper/step/:stepNo', component: add_shipment},
    {path: '/become-a-shipper/step/:stepNo/ad/:adId', component: add_shipment},
    {path: '/detail', component: detail},
    {
        path: '/profile', component: profile, children: [
            {path: '/', component: profile_setting},
            {path: 'photo', component: photo},
            {path: 'reviews-about-you', component: review},
            {path: 'reviews-by-you', component: review}
        ]
    }
]
