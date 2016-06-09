import serial
import time
import MySQLdb

eixo = 30.0
giroscopio = 0.3 
altitude = 2.0
temperatura = 1.0

def insertDataBase(valor):
	
	conn = MySQLdb.connect("localhost", "root", "123456", "projetox")
	cursor = conn.cursor()

	sql = """INSERT INTO dados(eixo_x, eixo_y, eixo_z, g_x, g_y, g_z, altitude, temperatura) VALUES (%s,%s,%s,%s,%s,%s,%s,%s);""" % (valor[0], valor[1], valor[2], valor[3], valor[4], valor[5], valor[6], valor[7])
	
	try:
		cursor.execute(sql)
		conn.commit()

	except:
		conn.rollback()

	conn.close()

valorSerial1 = []
valorSerial2 = []

while 1:
	# Iniciando conexao serial
	if (len(valorSerial1) == 8):
		valorSerial2 = valorSerial1

	ser = serial.Serial('/dev/ttyACM0', 115200, timeout=1)

	if (ser.readline() != ""):
		
		valorSerial = ser.readline().split('\n')
		valorSerial1 = valorSerial[0].split(',')

		print("Valor Serial 1:"), valorSerial1
		print("Valor Serial 2:"), valorSerial2

		if (len(valorSerial1) == 8 and len(valorSerial2) == 8):
			if (float(valorSerial1[0])-float(valorSerial2[0])) > -eixo and (float(valorSerial1[0])-float(valorSerial2[0]) < eixo):
				if (float(valorSerial1[1])-float(valorSerial2[1])) > -eixo and (float(valorSerial1[1])-float(valorSerial2[1]) < eixo):
					if (float(valorSerial1[2])-float(valorSerial2[2])) > -eixo and (float(valorSerial1[2]),float(valorSerial2[2]) < eixo):
						if (float(valorSerial1[3])-float(valorSerial2[3])) > -giroscopio and (float(valorSerial1[3])-float(valorSerial2[3]) < giroscopio):
							if (float(valorSerial1[4])-float(valorSerial2[4])) > -giroscopio and (float(valorSerial1[4])-float(valorSerial2[4]) < giroscopio):
								if (float(valorSerial1[5])-float(valorSerial2[5])) > -giroscopio and (float(valorSerial1[5])-float(valorSerial2[5]) < giroscopio):
									if (float(valorSerial1[6])-float(valorSerial2[6])) > -altitude and (float(valorSerial1[6])-float(valorSerial2[6]) < altitude):
										if (float(valorSerial1[7])-float(valorSerial2[7])) > -temperatura and (float(valorSerial1[7])-float(valorSerial2[7]) < temperatura):
											print "Valores validos!!"
											insertDataBase(valorSerial1)
			
		else:
			print("Falha no envio de algum valor!")
	else:
		print ("Sistema desconectado!")
	time.sleep(1)
	
