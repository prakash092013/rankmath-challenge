# Rankmath WP Admin Custom Widget

[Video Explanation](https://www.dropbox.com/s/adbpmqmae3qqanu/Screen%20Recording%202023-04-26%20at%208.12.50%20AM.mov?dl=0) of the Plugin.

Plugin to add a Dashboard Widget in WP Admin area. Displaying charts using [library](https://recharts.org). We have used ReactJS to display teh Charts and fetched the data by creating custom WP REST API end points.

Custom WP REST API end points used:
- <SITEURL>/wp-json/rankmath-inspector/v1/week for fetching data of last 7 days
- <SITEURL>/wp-json/rankmath-inspector/v1/half-month for fetching data of last 15 days
- <SITEURL>/wp-json/rankmath-inspector/v1/month for fetching data of last 30 days
 
All the above REST API end points publically.

This project was bootstrapped with [Create React App](https://github.com/facebook/create-react-app).

## Available Scripts

In the project directory, you can run:

### `npm start`

Runs the app in the development mode.\
Open [http://localhost:3000](http://localhost:3000) to view it in your browser.

The page will reload when you make changes.\
You may also see any lint errors in the console.

### `npm test`

Launches the test runner in the interactive watch mode.\
See the section about [running tests](https://facebook.github.io/create-react-app/docs/running-tests) for more information.

### `npm run build`

Builds the app for production to the `build` folder.\
It correctly bundles React in production mode and optimizes the build for the best performance.

The build is minified and the filenames include the hashes.\
Your app is ready to be deployed!

See the section about [deployment](https://facebook.github.io/create-react-app/docs/deployment) for more information.

### `npm run eject`

**Note: this is a one-way operation. Once you `eject`, you can't go back!**

If you aren't satisfied with the build tool and configuration choices, you can `eject` at any time. This command will remove the single build dependency from your project.

Instead, it will copy all the configuration files and the transitive dependencies (webpack, Babel, ESLint, etc) right into your project so you have full control over them. All of the commands except `eject` will still work, but they will point to the copied scripts so you can tweak them. At this point you're on your own.

You don't have to ever use `eject`. The curated feature set is suitable for small and middle deployments, and you shouldn't feel obligated to use this feature. However we understand that this tool wouldn't be useful if you couldn't customize it when you are ready for it.
