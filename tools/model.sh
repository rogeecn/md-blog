#!/bin/bash

php yii gii/model --interactive=0 --baseClass="common\base\ActiveRecord" --ns="common\models" --overwrite=0 --tableName="*"