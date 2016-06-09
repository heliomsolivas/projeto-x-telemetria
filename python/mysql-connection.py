import serial
import time
import MySQLdb

def InsertDataBase(valor):
	
	conn = MySQLdb.connect("localhost", "root", "123456", "projetox")
	cursor = conn.cursor()

	query = ("INSERT INTO dados(eixo_x, eixo_y, eixo_z, g_x, g_y, g_z, altitude, temperatura) VALUES (%s);") % (valor[0])	

	print query

	sql = """INSERT INTO dados(eixo_x, eixo_y, eixo_z, g_x, g_y, g_z, altitude, temperatura) VALUES (%s);""" % valor[0]
	
	try:
		cursor.execute(sql)
		conn.commit()

	except:
		conn.rollback()

	conn.close()
while 1:
	# Iniciando conexao serial
	ser = serial.Serial('/dev/ttyACM0', 115200, timeout=1)

	if (ser.readline() != ""):
		InsertDataBase(ser.readline().split('\n'))
	time.sleep(1)
	
