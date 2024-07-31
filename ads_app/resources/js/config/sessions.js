const sessionConfig = {
    duration: 900 , // 15 minutes
    popModalTime: 30, // this will pop a countdown modal that the user will choose continue or logout
    refreshTokenTimeLeft: 300 // when the session duration is 300 seconds left the next request will refresh the token
}

export default sessionConfig;
