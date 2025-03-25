const express = require('express');
const fetch = require('node-fetch');
const bodyParser = require('body-parser');
require('dotenv').config();

const app = express();
app.use(bodyParser.urlencoded({ extended: true }));

const SMS_API = {
    apiUrl: "https://api.africastalking.com/version1/messaging",
    apiKey: process.env.AFRICAS_TALKING_API_KEY,
    username: "postbusmalawi",
    senderId: "PostBus"
};

app.post('/send-sms', async (req, res) => {
    const { to, message } = req.body;

    const formData = new URLSearchParams();
    formData.append('username', SMS_API.username);
    formData.append('to', to);
    formData.append('message', message);
    formData.append('from', SMS_API.senderId);

    try {
        const response = await fetch(SMS_API.apiUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'apiKey': SMS_API.apiKey
            },
            body: formData
        });

        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }

        const data = await response.json();
        res.json(data);
    } catch (error) {
        console.error('Error sending SMS:', error);
        res.status(500).json({ error: error.message });
    }
});

app.listen(3000, () => {
    console.log('Server is running on port 3000');
});
