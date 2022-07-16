import List from "@mui/material/List";
import {ListItem, ListItemButton} from "@mui/material";
import ListItemText from "@mui/material/ListItemText";
import * as React from "react";
import Typography from "@mui/material/Typography";
import ListItemAvatar from "@mui/material/ListItemAvatar";
import Avatar from "@mui/material/Avatar";

export const MessageList = () => {
  return(
          <List sx={{ width: '100%', bgcolor: 'background.paper' }}>
              <ListItem alignItems="center" divider={true}>
                  <ListItemText className={'right-text color-main'}
                                primary="Anton"
                                secondary={
                                    <React.Fragment>
                                        <Typography
                                            sx={{ display: 'inline' }}
                                            component="span"
                                            variant="body2"
                                            color="text.primary"
                                        >
                                            Ali Connors Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus ad ex ipsam ipsum labore libero nemo quae quisquam rerum sapiente, unde veritatis voluptas. Ad beatae ipsa laborum obcaecati quaerat quod.
                                        </Typography>
                                    </React.Fragment>
                                }
                  />
                  <ListItemAvatar className={'margin-right'}>
                      <Avatar alt="Remy Sharp" src="/static/images/avatar/1.jpg" />
                  </ListItemAvatar>
              </ListItem>
              <ListItemButton alignItems="flex-start">
                  <ListItemAvatar>
                      <Avatar alt="Travis Howard" src="/static/images/avatar/2.jpg" />
                  </ListItemAvatar>
                  <ListItemText
                      primary="Summer BBQ"
                      secondary={
                          <React.Fragment>
                              <Typography
                                  sx={{ display: 'inline' }}
                                  component="span"
                                  variant="body2"
                                  color="text.primary"
                              >
                                  to Scott, Alex, Jennifer
                              </Typography>
                              {" — Wish I could come, but I'm out of town this…"}
                          </React.Fragment>
                      }
                  />
              </ListItemButton>
              <ListItemButton alignItems="flex-start">
                  <ListItemAvatar>
                      <Avatar alt="Cindy Baker" src="/static/images/avatar/3.jpg" />
                  </ListItemAvatar>
                  <ListItemText
                      primary="Oui Oui"
                      secondary={
                          <React.Fragment>
                              <Typography
                                  sx={{ display: 'inline' }}
                                  component="span"
                                  variant="body2"
                                  color="text.primary"
                              >
                                  Sandra Adams
                              </Typography>
                              {' — Do you have Paris recommendations? Have you ever…'}
                          </React.Fragment>
                      }
                  />
              </ListItemButton>
          </List>
      )
}