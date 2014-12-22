# RUT Formatting

Load the behavior in the `config/web.php`:


    'formatter' => [
        'class' => \yii\i18n\Formatter::className(),
        'as rutFormatter' => \fsateler\rut\RutFormatBehavior::className(),
    ],

Or if you use another formatter class, add the behavior:

    public function behaviors() {
        return [ \fsateler\rut\RutFormatBehavior::className() ];
    }


Then you can use `Yii::$app->formatter->asRut()`, or specify the `rut` format in `GridView` or `DetailView`.

# Rut Validator

In your model rules, add:

    ['property', \fsateler\rut\RutFormatBehavior::className()]
