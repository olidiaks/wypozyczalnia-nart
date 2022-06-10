const HtmlWebpackPlugin = require('html-webpack-plugin')
const output = __dirname + '/dist'
const entry = __dirname + '/src/'
module.exports = {
    // mode: 'development',
    mode: "production",
    entry: {
        "add helmets": entry + "add helmets.js",
        register: entry + "register.js",
        "add ski boots": entry + "add ski boots.js",
        "add ski pole": entry + "add ski pole.js",
        "add skis": entry + "add skis.js",
        "lend": entry + "lend.js",
        "login": entry + "login.js",
        "main": entry + "main.js",
        "whats actually landed": entry + "whats actually landed"
    },
    output: {
        path: output,
        filename: '[name].js',
        assetModuleFilename: '[name][ext]',
    },
    devtool: 'source-map',
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: ['@babel/preset-env'],
                    },
                },
            },
            {
                test: /\.(png|svg|jpg|jpeg|gif)$/i,
                type: 'asset/resource',
            },
        ],
    },
    plugins: [
        new HtmlWebpackPlugin({
            filename: "add helmets.html",
            template: "src/add helmets.html",
            minify: true,
            inject: false,
        }),
        new HtmlWebpackPlugin({
            filename: "add helmets.php",
            template: "src/add helmets.php",
            inject: false,
            minify: false,
        }),
        new HtmlWebpackPlugin({
            filename: "add ski boots.php",
            template: "src/add ski boots.php",
            inject: false,
            minify: false,
        }),
        new HtmlWebpackPlugin({
            filename: "add ski boots.html",
            template: "src/add ski boots.html",
            minify: true,
            inject: false
        }),
        new HtmlWebpackPlugin({
            filename: "add ski pole.php",
            template: "src/add ski pole.php",
            inject: false,
            minify: false,
        }),
        new HtmlWebpackPlugin({
            filename: "add ski pole.html",
            template: "src/add ski pole.html",
            minify: true,
            inject: false
        }),
        new HtmlWebpackPlugin({
            filename: "add skis.php",
            template: "src/add skis.php",
            inject: false,
            minify: false
        }),
        new HtmlWebpackPlugin({
            filename: "add skis.html",
            template: "src/add skis.html",
            minify: true,
            inject: false
        }),
        new HtmlWebpackPlugin({
            filename: "database.php",
            template: "src/database.php",
            inject: false,
            minify: false
        }),
        new HtmlWebpackPlugin({
            filename: "lend.php",
            template: "src/lend.php",
            minify: true,
            inject: false
        }),
        new HtmlWebpackPlugin({
            filename: "lend backend.php",
            template: "src/lend backend.php",
            inject: false,
            minify:  false
        }),
        new HtmlWebpackPlugin({
            filename: 'Register.html',
            template: "src/Register.html",
            minify: true,
            inject: false
        }),
        new HtmlWebpackPlugin({
            filename: "register.php",
            template: "src/register.php",
            inject: false,
            minify: true
        }),
        new HtmlWebpackPlugin({
            filename: "login.html",
            template: "src/login.html",
            minify: true,
            inject: false
        }),
        new HtmlWebpackPlugin({
            filename: "login.php",
            template: "src/login.php",
            minify: false,
            inject: false,
        }),
        new HtmlWebpackPlugin({
            filename: "main.php",
            template: "src/main.php",
            minify: true,
            inject: false,
        }),
        new HtmlWebpackPlugin({
            filename: "whats actually landed.php",
            template: "src/whats actually landed.php",
            minify: true,
            inject: false
        }),
        new HtmlWebpackPlugin({
            filename: "logout.php",
            template: "src/logout.php",
            minify: false,
            inject: false
        })
    ],
}