import sys

directory=sys.argv[1]

textfile = open('textfile.txt', 'w+')
textfile.write(directory)
textfile.close()

