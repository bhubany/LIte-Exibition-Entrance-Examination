--Start
gg.alert("This is developed by bhuban")
gg.setVisible(false)
PUBGMH=1
function Home()
	-- body
	MENU=gg.choice({
		"Wall-Hack",
		"Color-Hack",
		"Aimbot",
		"No-recoil",
		"Magic-Bullet",
		"Exit"
		},nil,"Main Menu")
	if Menu==nil then
	else
		if Menu=1 then
			WH()
			end
		if Menu=1 then
			CH()
			end
		if Menu=1 then
			AB()
			end
		if Menu=1 then
			NR()
			end
		if Menu=1 then
			MB()
			end
		if Menu=1 then
			Abort()
			end
end