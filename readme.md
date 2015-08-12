## Soccer API

Api to retrieve soccer data.

## Installation

Run composer install.

Copy and rename the .env.example file in root to .env

Create your database in /storage name it database.sql or edit the config folder to allow different location or name.

Directories within the storage and the bootstrap/cache directories should be writable by your web server.

In the root directory run **php artisan migrate**.

To run the server run the command **php artisan serve**.

## Usage

Once the server is up and running you can to localhost:8000 in your browser. You'll be required to sign up. After that create your api key. Delete or reset is available incase the key is compromised. Head over to the file link and upload the soccer.dat file to populate the database. You are ready to use the api.

## API
You have serveral api calls. All calls require an api key and return json.

Example: `localhost:8000/api/list?key={apikeyhere}`

`api/list` will return json with all data.

`api/top` will return top goal differences.

`api/create` will allow to create a entry in the data. This requires the name of the team with all other fields optional. Parameters: 'name', 'wins', 'loses', 'draws', 'goals_for', 'goals_against', 'points', 'last_game_day'

`api/edit/{id}` allows to edit existing data with a given id. All fields(mentioned above) can be updated.

`api/delete/{id}` will delete data with a given id.
