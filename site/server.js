const express = require('express');
const path = require('node:path');

const app = express();

app.get('/login', (req, res) => {
    res.sendFile(path.join(__dirname, 'public/login.html'));
});

app.get('/', (req, res) => {
    res.sendFile(path.join(__dirname, 'public/index.html'));
});

app.listen(3000, () => console.log('Example app is listening on port 3000.'));
