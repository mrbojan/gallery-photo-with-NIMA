from keras.models import Model
from keras.layers import Dense, Dropout
from keras.applications.nasnet import NASNetMobile
from config import IMAGE_SIZE


class NimaModel(object):
    def __init__(self):
        self.base_model = NASNetMobile(input_shape=(IMAGE_SIZE, IMAGE_SIZE, 3),
                                  include_top=False, pooling='avg',
                                  weights='imagenet')
        x = Dropout(0.75)(self.base_model.output)
        x = Dense(10, activation='softmax', name='toplayer')(x)

        self.model = Model(self.base_model.input, x)
