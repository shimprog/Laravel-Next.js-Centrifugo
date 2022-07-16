import Container from "@mui/material/Container";
import Header from "./Header";
import * as React from "react";

export default function Layout({ children }) {
    return (
        <>
            <Container maxWidth="md">
                <Header/>
                {children}
            </Container>
        </>
    )
}