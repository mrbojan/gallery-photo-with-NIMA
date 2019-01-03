import argparse
import csv

import numpy as np
from path import Path
from tqdm import tqdm

from config import weights_file
from nasnet_model import *
from utils.image_utils import preprocess_for_evaluation
from utils.score_utils import mean_score, std_score

file = open('textfile.txt','r')
directory = file.read()
parser = argparse.ArgumentParser(
    description='Evaluate NIMA(NASNet mobile)')
parser.add_argument('--dir', type=str, default= directory,
                    help='Pass a directory to evaluate the images in it')

parser.add_argument('--img', type=str, default=[None], nargs='+',
                    help='Pass one or more image paths to evaluate them')

args = parser.parse_args()

# give priority to directory
if args.dir is not None:
    print("Loading images from directory : ", args.dir)
    imgs = Path(args.dir).files('*.png')
    imgs += Path(args.dir).files('*.jpg')
    imgs += Path(args.dir).files('*.jpeg')

elif args.img[0] is not None:
    print("Loading images from path(s) : ", args.img)
    imgs = args.img

else:
    raise RuntimeError(
        'Either --dir or --img arguments must be passed as argument')

# load model
nima_model = NimaModel()
model = nima_model.model
model.load_weights(weights_file)

# calculate scores
scored_images = []
for img_path in tqdm(imgs):
    try:
        x = preprocess_for_evaluation(img_path)
    except OSError as e:
        print("Couldn't process {}".format(img_path))
        print(e)
        continue
    x = np.expand_dims(x, axis=0)
    scores = model.predict(x, batch_size=1, verbose=0)[0]

    mean = mean_score(scores)
    std = std_score(scores)
    scored_images.append((mean, std, img_path.name))

	
import pymysql.cursors

# Connect to the database
connection = pymysql.connect(host='localhost',
                             user='root',
                             password='',
                             db='wolfmania',
                             charset='utf8mb4',
                             cursorclass=pymysql.cursors.DictCursor)

myCursor = connection.cursor()

myCursor.execute("""select id,file_name from  %s """ %directory)

result = myCursor.fetchall()
final=[]
for i in range(len((result))):
    for j in range(len((result))):
        if (str(result[i]['file_name']) == str(scored_images[j][2])):
            final.append([result[i]['id'],result[i]['file_name'],scored_images[j][0],scored_images[j][1]])

for i in range(len(final)):
    a=str(final[i][2])
    b=str(final[i][0])
    c=str(final[i][3])
    myCursor.execute("""UPDATE {0} SET `AFTER` = {1} WHERE {2}.`id` = {3}
                    """ .format(directory, a ,directory, b))
    myCursor.execute("""UPDATE {0} SET `std` = {1} WHERE {2}.`id` = {3}
                    """ .format(directory, c ,directory, b))
connection.commit()
connection.close()

import os
os.remove("textfile.txt")

	
