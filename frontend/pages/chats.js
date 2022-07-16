import * as React from 'react';
import ChatList from "../component/ChatList";
import Layout from "../component/layout";


export default function Chats({chatList}) {
    return (
        <ChatList/>

    )
}
Chats.getLayout = function getLayout(page) {
    return (
        <Layout>
            {page}
        </Layout>
    )
}