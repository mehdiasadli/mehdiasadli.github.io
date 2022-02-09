const express = require('express');
const cors = require('cors');
const app = express();
const tasks = require('./routes/tasks');
const connectDB = require('./db/connect')
require('dotenv').config()

// middleware
app.use(express.static('./public'));
app.use(express.json());
app.use(cors());

// routes
app.use('/api/v1/tasks', tasks)

const PORT = 5500;

const start = async () => {
    try {
        await connectDB(process.env.MONGO_URI)
        app.listen(PORT, console.log(`Server is running on port ${PORT}`))
    } catch (error) {
        console.log(error);
    }
}

start()


