import * as React from 'react';
import Container from '@mui/material/Container';
import Header from "../component/Header";
import {Bread} from "../component/Bread";
import {TextField} from "@mui/material";
import Button from "@mui/material/Button";
import SendIcon from '@mui/icons-material/Send';
import {MessageList} from "../component/MessageList";
import Layout from "../component/layout";

export default function Chat({chatList}) {
    return (
        <React.Fragment>
            <Bread/>
            <MessageList/>
            <Container maxWidth="md" className={'flex-row'}>
                <TextField
                    hiddenLabel
                    id="filled-hidden-label-normal"
                    variant="filled"
                    fullWidth={true}
                />
                <Button variant="contained" endIcon={<SendIcon/>}>
                    Send
                </Button>
            </Container>
        </React.Fragment>
    )
}

Chat.getLayout = function getLayout(page) {
    return (
        <Layout>
            {page}
        </Layout>
    )
}