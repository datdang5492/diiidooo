import homepage from './components/homepage/Homepage';
import list from './components/list/List';
import profile from './components/profile/Profile';
import profile_setting from './components/profile/profile_setting/ProfileSetting';
import photo from './components/profile/media/Photo';
import review from './components/profile/review/Review';
import add_shipment from './components/list/AddShipment';
import shipment_detail from "./components/list/ShipmentDetail";
import payment from "./components/list/payment/Payment";

export default [
    {path: '/', component: homepage},
    {path: '/list/from/:fromCity/to/:toCity', component: list},
    {path: '/list/detail/:id', component: shipment_detail},
    {path: '/list/payment/:id', component: payment},

    {path: '/become-a-shipper/step/:stepNo', component: add_shipment},
    {path: '/become-a-shipper/step/:stepNo/ad/:adId', component: add_shipment},
    {
        path: '/profile', component: profile, children: [
            {path: '/', component: profile_setting},
            {path: 'photo', component: photo},
            {path: 'reviews-about-you', component: review},
            {path: 'reviews-by-you', component: review}
        ]
    }
]
