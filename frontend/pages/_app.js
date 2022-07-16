import '../styles.css'
import CentrifugeContext from "../contexts/Centrifuge";
import {useEffect, useState} from "react";
import Cookies from 'js-cookie'
import Centrifuge from "centrifuge";


export default function MyApp({Component, pageProps}) {
    const getLayout = Component.getLayout || ((page) => page)
    const [stateCentrifuge, setCentrifuge] = useState()
    useEffect(async () => {
        if (!!Cookies.get('token-socket')) {
            let centrifuge = new Centrifuge('ws://localhost:8081/connection/websocket');

            centrifuge.setToken(Cookies.get('token-socket'));

            centrifuge.subscribe("channel", function (message) {
                console.log(message);
            });

            centrifuge.connect();
            setCentrifuge(centrifuge)
        } else {
            if (!!Cookies.get('token')) {
                try {
                    const request = await fetch(`${process.env.NEXT_PUBLIC_BACK_MAIN}/api/register`,{
                        method: 'GET',
                        headers:{
                            'Authorization': `Bearer ${Cookies.get('token')}`,
                            'Security': `${process.env.NEXT_PUBLIC_SECURITY_KEY}`
                        }
                    })
                    const response = await request.json()
                    console.log(response)

                } catch (e) {
                    Cookies.remove('token')
                    console.log('bad token')
                }
            }
        }
    },[])
    console.log(process.env.NEXT_PUBLIC_BACK_MAIN)
    console.log(process.env.NEXT_PUBLIC_SECURITY_KEY)

    return getLayout(
        <CentrifugeContext.Provider value={[stateCentrifuge, setCentrifuge]}>
            <Component {...pageProps} />
        </CentrifugeContext.Provider>
    )
}
