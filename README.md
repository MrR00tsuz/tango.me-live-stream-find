# Tango Stream URL Extractor

This project allows you to extract stream URLs from a given URL using the Tango API. The URLs are returned in JSON format, which can be used for streaming or other purposes.

## Example

Given the following input URL:
http://localhost/tango.php?streamid=zfv1UB7Puk0Hne9biD4T7Q (https://tango.me/stream/zfv1UB7Puk0Hne9biD4T7Q)

The output will be in the following format:

```json
{
    "error": false,
    "urls": [
        "https://cinema-de41.tango.me/v2/35013297def68ff930f69f570a7e2e2e/master.m3u8?token=NTc5NDJkNjE3MTlkYmFkYjU0YTljNTI2Y2Y1MmYxNDEyZDA0NTljYmM2N2IyNjY5OGI3NTRkMmE1YmI2MjYxOQ&expire_at=1743242428Z",
        "https://cinema-de41.tango.me/v2/35013297def68ff930f69f570a7e2e2e/master.m3u8?token=NTc5NDJkNjE3MTlkYmFkYjU0YTljNTI2Y2Y1MmYxNDEyZDA0NTljYmM2N2IyNjY5OGI3NTRkMmE1YmI2MjYxOQ&expire_at=1743242428b",
        "https://cinema-de41.tango.me/v2/ad3954072a99f427e7879e2fbb2579b4/preview.m3u8?token=OGJhMDVmNzExNWQxMjg3MTg4YWEwZWRkZmI5ODA2ZGJmN2Y5NDkwYjQ2Njg5MTJmNmFjZTAxNzhjNTZjMzA1NQ&expire_at=1743242428j",
        "https://cinema-de41.tango.me/v2/35013297def68ff930f69f570a7e2e2e/master.m3u8?token=NTc5NDJkNjE3MTlkYmFkYjU0YTljNTI2Y2Y1MmYxNDEyZDA0NTljYmM2N2IyNjY5OGI3NTRkMmE1YmI2MjYxOQ&expire_at=1743242428p",
        "https://cinema-de41.tango.me/v2/59e1a61ceeaae6decdfa545ffb6b7b14/ld.m3u8?token=MDY1ZmY0NTM1NDJiZTNkZWQ2OTYwZjAzZjA0YTRiMjgxNDZjOWUwOTcwY2Y1NjEwZTEyNTA1OWFiZTQ4ZmJiYg&expire_at=1743242428",
        "https://cinema-de41.tango.me/v2/35013297def68ff930f69f570a7e2e2e/master.m3u8?token=NTc5NDJkNjE3MTlkYmFkYjU0YTljNTI2Y2Y1MmYxNDEyZDA0NTljYmM2N2IyNjY5OGI3NTRkMmE1YmI2MjYxOQ&expire_at=1743242428",
        "https://cinema-de41.tango.me/v2/efffd9130fc7d938af14652705e63078/hd.m3u8?token=MjVhNTkwODI1ZWVjYzk3Mzg5NjgxYzgxNGJjMmUzZjJiM2JiOTNhOTIzMjE2NGI4Y2QyNzhmY2ZiMGExZjY3YQ&expire_at=1743242428\"",
        "https://cinema-de41.tango.me/v2/35013297def68ff930f69f570a7e2e2e/master.m3u8?token=NTc5NDJkNjE3MTlkYmFkYjU0YTljNTI2Y2Y1MmYxNDEyZDA0NTljYmM2N2IyNjY5OGI3NTRkMmE1YmI2MjYxOQ&expire_at=1743242428*",
        "https://cinema-de41.tango.me/v2/ad3954072a99f427e7879e2fbb2579b4/preview.m3u8?token=OGJhMDVmNzExNWQxMjg3MTg4YWEwZWRkZmI5ODA2ZGJmN2Y5NDkwYjQ2Njg5MTJmNmFjZTAxNzhjNTZjMzA1NQ&expire_at=1743242428"
    ]
}
```
## PHP Code (`tango.php`)

To interact with the Tango API, you will need to replace the placeholders (`YOUR`) in the PHP headers with your own credentials. You can obtain this information using the following tools:

```php
$headers = [
    "Accept-Encoding: gzip",
    "Authorization: Bearer YOUR",  // Replace 'YOUR' with your token
    "Connection: Keep-Alive",
    "foreground_id: YOUR",         // Replace 'YOUR' with your foreground ID
    "Host: gateway.lemonshcherbet.com",
    "interaction_id: YOUR",        // Replace 'YOUR' with your interaction ID
    "tg-carrier-country: cn",
    "tg-loc-country: TR",
    "tg-loc-language: tr",
    "tg-vpn: 1",
    "User-Agent: YOUR",            // Replace 'YOUR' with your User-Agent string
    "X-APP-AB: v=1;proxy=0;referrer=webgoodeta.com;pcidss=0",
    "X-App-Client-Session-Id: YOUR" // Replace 'YOUR' with your session ID
];
```
![image](https://github.com/user-attachments/assets/01590826-60e6-4fb5-a502-8c7bc71a0d60)

How to Obtain Your Credentials
You can use Memu and HTTP Toolkit to extract the necessary values for the placeholders:

Memu
Download Memu from here to run an Android emulator. Once Memu is installed, you can launch your app and capture the required values like foreground_id, interaction_id, and User-Agent from the app's network traffic.

HTTP Toolkit
Download HTTP Toolkit from here to monitor and debug HTTP requests. This tool will allow you to see the exact HTTP headers, including Authorization, foreground_id, interaction_id, and User-Agent, used by your app.

Once you have obtained these values, replace the placeholders in the PHP code above with the corresponding information.

