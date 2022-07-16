import {Breadcrumbs} from "@mui/material";
import Avatar from "@mui/material/Avatar";
import { styled } from '@mui/material/styles';
import Badge from '@mui/material/Badge';
import Button from "@mui/material/Button";
import Link from "next/link";

const StyledBadge = styled(Badge)(({ theme }) => ({
    '& .MuiBadge-badge': {
        backgroundColor: '#44b700',
        color: '#44b700',
        boxShadow: `0 0 0 2px ${theme.palette.background.paper}`,
        '&::after': {
            position: 'absolute',
            width: '100%',
            height: '100%',
            borderRadius: '50%',
            animation: 'ripple 1.2s infinite ease-in-out',
            border: '1px solid currentColor',
            content: '""',
        },
    },
    '@keyframes ripple': {
        '0%': {
            transform: 'scale(.8)',
            opacity: 1,
        },
        '100%': {
            transform: 'scale(2.4)',
            opacity: 0,
        },
    },
}));

export const Bread = () => {
  return(
      <div className={'bread'}>
          <Breadcrumbs aria-label="breadcrumb">
              <Link href={'/chats'}>
                  <Button variant="outlined">CHATS</Button>
              </Link>
              <StyledBadge
                  overlap="circular"
                  anchorOrigin={{ vertical: 'bottom', horizontal: 'right' }}
                  variant="dot"
              >
                  <Avatar alt="Remy Sharp" src="https://mui.com/static/images/avatar/1.jpg" />
              </StyledBadge>
          </Breadcrumbs>
      </div>

  )
}